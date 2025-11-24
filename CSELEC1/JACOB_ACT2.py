import multiprocessing
import random
import time
import matplotlib.pyplot as plt

# Sequential merge sort
def merge(left, right):
    result = []
    i = j = 0
    while i < len(left) and j < len(right):
        if left[i] <= right[j]:
            result.append(left[i])
            i += 1
        else:
            result.append(right[j])
            j += 1
    result.extend(left[i:])
    result.extend(right[j:])
    return result

def merge_sort_seq(arr):
    if len(arr) <= 1:
        return arr
    mid = len(arr) // 2
    left = merge_sort_seq(arr[:mid])
    right = merge_sort_seq(arr[mid:])
    return merge(left, right)

# Parallel merge sort (two halves only)
def merge_sort_parallel(arr):
    if len(arr) <= 1:
        return arr

    mid = len(arr) // 2
    left = arr[:mid]
    right = arr[mid:]

    with multiprocessing.Pool(processes=2) as pool:
        left_sorted, right_sorted = pool.map(merge_sort_seq, [left, right])

    return merge(left_sorted, right_sorted)

# Measure execution time
def measure_time(func, arr):
    start = time.time()
    func(arr)
    end = time.time()
    return end - start

# Main program
def main():
    sizes = [10000, 50000, 100000] # Array sizes to test
    seq_times = []
    par_times = []

    for size in sizes:
        arr = [random.randint(0, 1000000) for _ in range(size)]

        t_seq = measure_time(merge_sort_seq, arr.copy())
        t_par = measure_time(merge_sort_parallel, arr.copy())

        print(f"Array size: {size}")
        print(f"Sequential Merge Sort: {t_seq:.4f} s")
        print(f"Parallel Merge Sort:   {t_par:.4f} s\n")

        seq_times.append(t_seq)
        par_times.append(t_par)

    # Plot results
    plt.plot(sizes, seq_times, label="Sequential", marker='o')
    plt.plot(sizes, par_times, label="Parallel", marker='o')
    plt.xlabel("Array Size")
    plt.ylabel("Time (seconds)")
    plt.title("Sequential vs Parallel Merge Sort")
    plt.legend()
    plt.grid(True)
    plt.show()

if __name__ == "__main__":
    main()
