#include <stdio.h>
#include <stdlib.h>
#include <omp.h>

int main() {
    int n = 1000000;
    double *arr = (double *) malloc(n * sizeof(double));
    double sum = 0.0;
    double start, end;

    // Initialize array
    for (int i = 0; i < n; i++) {
        arr[i] = i * 0.5;
    }

    // Parallel sum
    start = omp_get_wtime();
    #pragma omp parallel for reduction(+:sum)
    for (int i = 0; i < n; i++) {
        sum += arr[i];
    }
    end = omp_get_wtime();

    printf("Parallel Sum: %.2f\n", sum);
    printf("Parallel Time: %f seconds\n", end - start);

    free(arr);
    return 0;
}
