#include <iostream>
#include <pthread.h>
#include <cstdlib>

using namespace std;

void* compute_square(void* arg) {
    int num = *static_cast<int*>(arg);   
    int* result = new int;               
    *result = num * num;                 

    pthread_exit(result);                
}

int main() {
    pthread_t thread1, thread2;
    int num1 = 5, num2 = 10;

    // Create threads
    pthread_create(&thread1, nullptr, compute_square, &num1);
    pthread_create(&thread2, nullptr, compute_square, &num2);

    // Variables to store returned results
    int* result1;
    int* result2;

    // Join threads
    pthread_join(thread1, (void**)&result1);
    pthread_join(thread2, (void**)&result2);

    // Sum the results
    int sum = *result1 + *result2;

    // Print results
    cout << "Result from thread 1: " << *result1 << endl;
    cout << "Result from thread 2: " << *result2 << endl;
    cout << "Sum of results: " << sum << endl;

    // Free memory
    delete result1;
    delete result2;

    return 0;
}
