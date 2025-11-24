import math
import time
from multiprocessing import Pool, cpu_count

numbers = [100000, 120000, 140000, 160000, 180000, 200000]

def compute_factorial(n):
    return math.factorial(n)


start = time.time()

with Pool(cpu_count()) as pool:
    results = pool.map(compute_factorial, numbers)

end = time.time()
print("Parallel computation finished.")
print(f"Execution Time (Parallel): {end - start:.4f} seconds")
