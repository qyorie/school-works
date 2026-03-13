// Author: Troy Tristan Jacob
// Course/Year/Section: BSCS-3A

#include <iostream>
using namespace std;

int main() {
    int a = 0, b = 1, next;

    cout << "Fibonacci Sequence (10 numbers): " << endl;

    for(int i = 0; i < 10; i++) {
        cout << a << " ";
        next = a + b;
        a = b;
        b = next;
    }

    return 0;
}