//• E6.12 Write a program that prints all powers of 2 from 20up to 220.
package powerm;
  public class PowerM {
    public static void main(String[] args) {
       int number =0;
       int resalt = 0 ;
       while(resalt < Math.pow(2, 20)){
       resalt=(int) Math.pow (2, number);
       System.out.println( resalt);
       number++;
      }
     }
    }