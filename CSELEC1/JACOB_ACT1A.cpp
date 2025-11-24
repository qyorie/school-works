#include <iostream>
#include <vector>
#include <omp.h>
using namespace std;

int main() {
    const int N = 1000000;
    vector<int> arr(N, 1); // Fill array with 1s
    double start, end;

    start = omp_get_wtime();

    long long sum = 0;
    for (int i = 0; i < N; i++) {
        sum += arr[i];
    }

    end = omp_get_wtime();

    cout << "Sequential Sum: " << sum << endl;
    cout << "Sequential Time: " << (end - start) << " seconds\n";

    return 0;
}
