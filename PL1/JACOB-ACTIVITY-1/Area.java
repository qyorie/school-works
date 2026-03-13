// Author: Troy Tristan Jacob
// Course/Year/Section: BSCS-3A

abstract class Shape {
    abstract double calculateArea();
}

class Circle extends Shape {
    double radius;

    Circle(double radius) {
        this.radius = radius;
    }

    double calculateArea() {
        return Math.PI * radius * radius;
    }
}

class Rectangle extends Shape {
    double length;
    double width;

    Rectangle(double length, double width) {
        this.length = length;
        this.width = width;
    }

    double calculateArea() {
        return length * width;
    }
}

public class Area {
    public static void main(String[] args) {

        Circle c = new Circle(5);
        Rectangle r = new Rectangle(4, 6);

        System.out.println("Area of Circle: " + c.calculateArea());
        System.out.println("Area of Rectangle: " + r.calculateArea());
    }
}