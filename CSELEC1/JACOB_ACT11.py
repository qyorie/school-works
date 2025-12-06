import math
import random

# -----------------------------
# 1. GRAPH REPRESENTATION
# -----------------------------

# 10 fictional delivery locations on a 10×10 grid
coordinates = {
    "A": (1, 3),
    "B": (4, 8),
    "C": (7, 6),
    "D": (9, 2),
    "E": (6, 1),
    "F": (3, 5),
    "G": (8, 9),
    "H": (2, 7),
    "I": (5, 2),
    "J": (7, 3)
}

cities = list(coordinates.keys())

# Distance function
def distance(a, b):
    ax, ay = coordinates[a]
    bx, by = coordinates[b]
    return math.sqrt((ax - bx)**2 + (ay - by)**2)

# Compute full tour length
def tour_distance(tour):
    total = 0
    for i in range(len(tour) - 1):
        total += distance(tour[i], tour[i+1])
    total += distance(tour[-1], tour[0])  # return to start
    return total


# -----------------------------
# 2. HILL CLIMBING
# -----------------------------
def swap_two_cities(tour):
    """Create a neighbor by swapping two random cities."""
    new_tour = tour[:]
    i, j = random.sample(range(len(tour)), 2)
    new_tour[i], new_tour[j] = new_tour[j], new_tour[i]
    return new_tour


def hill_climbing(initial_tour):
    current = initial_tour
    current_distance = tour_distance(current)
    iterations = 0

    while True:
        iterations += 1
        neighbor = swap_two_cities(current)
        neighbor_distance = tour_distance(neighbor)

        # Accept only better neighbors
        if neighbor_distance < current_distance:
            current = neighbor
            current_distance = neighbor_distance
        else:
            break  # local optimum

    return current, current_distance, iterations


# -----------------------------
# 3. SIMULATED ANNEALING
# -----------------------------
def simulated_annealing(initial_tour, T=100, cooling_rate=0.95):
    current = initial_tour[:]
    current_distance = tour_distance(current)

    best = current[:]
    best_distance = current_distance

    steps = 0

    while T > 0.01:
        steps += 1
        neighbor = swap_two_cities(current)
        neighbor_distance = tour_distance(neighbor)

        delta = neighbor_distance - current_distance

        # If better, accept
        if delta < 0:
            current = neighbor
            current_distance = neighbor_distance
        else:
            # Accept worse with probability
            if random.random() < math.exp(-delta / T):
                current = neighbor
                current_distance = neighbor_distance

        # Track global best
        if current_distance < best_distance:
            best = current[:]
            best_distance = current_distance

        # Cool temperature
        T *= cooling_rate

    return best, best_distance, steps


# -----------------------------
# 4. MAIN PROGRAM
# -----------------------------
if __name__ == "__main__":
    # Generate same initial random tour for both algorithms
    initial_tour = cities[:]
    random.shuffle(initial_tour)

    print("\nInitial Tour:", initial_tour)
    print("Initial Distance:", round(tour_distance(initial_tour), 3))

    # ---- Hill Climbing ----
    hc_tour, hc_dist, hc_iters = hill_climbing(initial_tour)
    print("\n===== HILL CLIMBING RESULTS =====")
    print("Best Route:", hc_tour)
    print("Total Distance:", round(hc_dist, 3))
    print("Iterations:", hc_iters)

    # ---- Simulated Annealing ----
    sa_tour, sa_dist, sa_steps = simulated_annealing(initial_tour)
    print("\n===== SIMULATED ANNEALING RESULTS =====")
    print("Best Route:", sa_tour)
    print("Total Distance:", round(sa_dist, 3))
    print("Cooling Steps:", sa_steps)

    # ---- Comparison ----
    print("\n===== COMPARISON =====")
    print("HC Distance:", round(hc_dist, 3))
    print("SA Distance:", round(sa_dist, 3))
    print("Better Algorithm:", "Simulated Annealing" if sa_dist < hc_dist else "Hill Climbing")
