import networkx as nx
import random as rand
import matplotlib.pyplot as plt

POPULATION_SIZE = 10
MUTATION_RATE = 0.60

def generate_graph(num_nodes, num_edges):
    """
    This function generates a graph and takes parameters num_nodes (number of nodes to create)
    and num_edges (number of edges in the graph) then returns the generated graph
    """
    return nx.gnm_random_graph(num_nodes, num_edges)

def generate_initial_population(graph):
    """
    This function takes a parameter "graph" to generate initial population. The number
    of population to be created depends on the value of "POPULATION_SIZE". 
    """
    poplutation = []
    for _ in range(POPULATION_SIZE):
        poplutation.append([rand.choice([0,1]) for _ in range(graph.number_of_nodes())])

    return poplutation

def mutation(offspring):
    child = []
    for i in range(len(offspring)):
        if rand.uniform(0.0, 1.0) < MUTATION_RATE:
            child.append(1)
        else:
            child.append(offspring[i])

    return child
def single_crossover(parent1, parent2):
    """
    It returns child1 and child2 after executing single crossover at random point
    """
    point = rand.randint(0,len(parent1))
    child1 = parent1[:point] + parent2[point:]
    child2 = parent1[point:] + parent2[:point]

    return child1, child2

def is_valid_cover(graph, sol):
    """
    returns true if the selected nodes covered ALL edges otherwise return false
    """
    for u, v in graph.edges:
        if sol[u] == 0 and sol[v] == 0:
            return False
    return True

def selection(population, fitness):
    """
    The function returns the best solution found in population using tournament selection. The function takes
    "population" and "fitness" parameters.
    """
    tournament_size = 3
    population = zip(population,fitness)
    candidate = tuple(population)[:tournament_size]
    best_solution = max(candidate, key=lambda x:x[1])[0]

    return best_solution

def print_layout(graph, sol):
    """
    Displays graph layout with selected nodes colored in red
    """
    n_list = []
    pos = nx.random_layout(graph)

    for i in range(len(sol)):
        if sol[i] == 1:
            n_list.append(i)
    
    nx.draw(graph, pos, with_labels=True)
    nx.draw_networkx_nodes(graph, pos, nodelist=n_list, node_color="tab:red")
    plt.show()



