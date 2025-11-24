import multiprocessing
import time

# Sequential prefix sum
def prefix_sum_seq(arr):
    if not arr:
        return []
    result = [arr[0]]
    for i in range(1, len(arr)):
        result.append(result[-1] + arr[i])
    return result

# Parallel prefix sum (two halves only)
def prefix_sum_parallel(arr):
    n = len(arr)
    if n == 0:
        return []

    if n < 10000:  # small arrays -> sequential
        return prefix_sum_seq(arr)

    mid = n // 2
    left = arr[:mid]
    right = arr[mid:]

    with multiprocessing.Pool(processes=2) as pool:
        left_sum, right_sum = pool.map(prefix_sum_seq, [left, right])

    # Add last element of left_sum to all elements of right_sum
    right_sum = [x + left_sum[-1] for x in right_sum]

    return left_sum + right_sum

# Main program
def main():
    arr = list(range(1, 21))  # small example
    print("Original array:", arr)

    # Measure time for sequential prefix sum
    start_seq = time.time()
    seq_result = prefix_sum_seq(arr)
    end_seq = time.time()
    print("Sequential Prefix Sum:", seq_result)
    print(f"Sequential execution time: {end_seq - start_seq:.6f} seconds\n")

    # Measure time for parallel prefix sum
    start_par = time.time()
    par_result = prefix_sum_parallel(arr)
    end_par = time.time()
    print("Parallel Prefix Sum:", par_result)
    print(f"Parallel execution time: {end_par - start_par:.6f} seconds")

if __name__ == "__main__":
    main()
