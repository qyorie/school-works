/*===========================================================*/
/* Filename: QUICK_SORT_JACOB.cpp                            */
/* Name: Troy Tristan Jacob                                  */
/* Course/Year/Section: BSCS-3A                              */
/* Description: This program implements the Quick            */
/*       Sort algorithm to sort an array of random integers. */
/*===========================================================*/


#include <iostream>
#include <vector>
#include <cstdlib>
#include <ctime>
using namespace std;

//function to partition the array
int partition(vector<int>& arr, int low, int high){
    int pivot = arr[high];
    int i = low - 1;
    //elements less than pivot to the left, greater to the right
    for (int j = low; j < high; j++){
        if (arr[j] < pivot){
            i++;
            swap(arr[i], arr[j]);
        }
    }
    swap(arr[i + 1], arr[high]);
    return i + 1;
}
//recursive quick sort function
void quickSort(vector<int>& arr, int low, int high){
    if (low < high){
        int pi = partition(arr, low, high);
        quickSort(arr, low, pi - 1);
        quickSort(arr, pi + 1, high);
    }
}
//main function
int main(){
    vector<int> arr;
    int n = 5;

    //generate random numbers
    srand(time(0));
    for (int i = 0; i < n; i++){
        arr.push_back(rand() % 100);
    }

    //print unsorted array
    cout << "Unsorted array: ";
    for (int i = 0; i < arr.size(); i++)
        cout << arr[i] << " ";
    cout << endl;

    quickSort(arr, 0, n - 1); //sort the array

    //print sorted array
    cout << "Sorted array: ";
    for (int i = 0; i < arr.size(); i++)
        cout << arr[i] << " ";
    cout << endl;

    return 0;
}