// Author: Troy Tristan Jacob
// Course/Year/Section: BSCS-3A

#include <iostream>
#include <vector>
using namespace std;

int main() {

    vector<int> fib = {0, 1};

    while (fib.size() < 10) {
        fib.push_back(fib[fib.size()-1] + fib[fib.size()-2]);
    }

    cout << "Fibonacci Sequence (10 numbers): " << endl;

    for (int n : fib) {
        cout << n << " ";
    }

    return 0;
}