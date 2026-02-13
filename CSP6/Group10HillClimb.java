// =====================================================
// Group 10: Hill Climbing Algorithm Implementation
// Group Members: 
//      Beldad, Jerald
//      Gascon, Joemart Angelu
//      Jacob, Troy Tristan
// =====================================================

import java.util.Random;

public class Group10HillClimb {

    // =====================================================
    // SCENARIO 1: Function Optimization
    // =====================================================

    static int function(int x) {
      return -x * x + 6 * x;
    }

    static int hillClimbFunction(int start) {
      int current = start;
      int step = 1;

      while (true) {
        int neighbor1 = current + step;
        int neighbor2 = current - step;

        int currentVal = function(current);
        int n1Val = function(neighbor1);
        int n2Val = function(neighbor2);

        if (n1Val > currentVal) {
          current = neighbor1;
        } else if (n2Val > currentVal) {
          current = neighbor2;
        } else {
          break;
        }
      }
      return current;
    }

    // =====================================================
    // SCENARIO 2: 8-Queens Problem
    // =====================================================

    static final int N = 8;
    static Random rand = new Random();

    static int[] generateBoard() {
      int[] board = new int[N];
      for (int i = 0; i < N; i++)
        board[i] = rand.nextInt(N);
      return board;
    }

    static int calculateConflicts(int[] board) {
      int conflicts = 0;
      for (int i = 0; i < N; i++) {
        for (int j = i + 1; j < N; j++) {
          if (board[i] == board[j] ||
              Math.abs(board[i] - board[j]) == j - i) {
            conflicts++;
          }
        }
      }
      return conflicts;
    }

    static int[] hillClimbQueens(int[] board) {
      int currentConflicts = calculateConflicts(board);

      while (true) {
        int[] bestNeighbor = board.clone();
        int bestConflicts = currentConflicts;

        for (int col = 0; col < N; col++) {
          for (int row = 0; row < N; row++) {
            int[] neighbor = board.clone();
            neighbor[col] = row;
            int conflicts = calculateConflicts(neighbor);

            if (conflicts < bestConflicts) {
              bestNeighbor = neighbor;
              bestConflicts = conflicts;
            }
          }
        }

        if (bestConflicts >= currentConflicts)
          break;

        board = bestNeighbor;
        currentConflicts = bestConflicts;
      }

      return board;
    }

    // =====================================================
    // SCENARIO 3: Grid Hill Climbing
    // =====================================================

    static int[][] grid = {
            {1, 2, 3},
            {4, 9, 6},
            {7, 8, 5}
    };

    static int[] hillClimbGrid(int row, int col) {
      int currentRow = row;
      int currentCol = col;

      while (true) {
        int bestRow = currentRow;
        int bestCol = currentCol;
        int currentValue = grid[currentRow][currentCol];

        int[][] directions = { {-1,0}, {1,0}, {0,-1}, {0,1} };

        for (int[] dir : directions) {
          int newRow = currentRow + dir[0];
          int newCol = currentCol + dir[1];

          if (newRow >= 0 && newRow < grid.length &&
              newCol >= 0 && newCol < grid[0].length) {

            if (grid[newRow][newCol] > currentValue) {
              bestRow = newRow;
              bestCol = newCol;
              currentValue = grid[newRow][newCol];
            }
          }
        }

        if (bestRow == currentRow && bestCol == currentCol)
          break;

        currentRow = bestRow;
        currentCol = bestCol;
      }

      return new int[]{currentRow, currentCol};
    }

  public static void main(String[] args) {

    // -------- Scenario 1 --------
    System.out.println("=== Scenario 1: Function Optimization ===");
    int start = 0;
    int optimal = hillClimbFunction(start);
    System.out.println("Optimal x: " + optimal);
    System.out.println("Maximum value: " + function(optimal));

    // -------- Scenario 2 --------
    System.out.println("\n=== Scenario 2: 8-Queens ===");
    int[] board = generateBoard();
    board = hillClimbQueens(board);
    System.out.println("Final conflicts: " + calculateConflicts(board));

    // -------- Scenario 3 --------
    System.out.println("\n=== Scenario 3: Grid Climbing ===");
    int[] peak = hillClimbGrid(0, 0);
    System.out.println("Reached peak at: (" + peak[0] + ", " + peak[1] + ")");
  }
}
