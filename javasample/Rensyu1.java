/**
 * 
 */
package javasample;

import java.util.Random;

/**
 * @author kanade71
 *
 */
public class Rensyu1 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		
		int weight = 60;
		
		if (weight == 60) {
			System.out.println("変数weightは60と正しいです");
		}
		
		int age1,age2;
		age1 = 11;
		age2 = 2;
		int age = (age1 + age2) * 3;
		
		if(age > 60) {
			System.out.println("変数ageは60を超えています");
		} else {
			System.out.println("超えていません。");
		}
		
		if(!(age % 2 == 0)) {
			System.out.println("変数ageは奇数です。");
		} else if (age % 2 == 0) {
			System.out.println("変数ageは偶数です。");
		}
		
		String name = "湊";
		
		if (name.equals("湊")) {
			System.out.println("あなたの名前は湊です。");
		}
		//ここを見て!!!!
		//メソッドの呼び出し出来たよ！
		//おじ天才
		int hungry_result = rand();
		System.out.println(hungry_result);
		
		String resultFood = randFood();
		System.out.println(resultFood);
		
		
		System.out.println("こんにちは");
		
		if(hungry_result == 0) {
			System.out.println("お腹いっぱいです");
		} else if(!(hungry_result == 0)) {
			System.out.println(resultFood + "をいただきます");
		} else {
			System.out.println("はらぺこですが食べるものがありません");
		}
		System.out.println("ごちそうさまでした");

	}
	//ここも見て!!!!!
	//乱数を求めて変数に格納するためのメソッド
	public static int rand() {
		
		Random rand = new Random();
		int isHungry = rand.nextInt(2);
		
		return isHungry;
			
	}
	
	public static String randFood() {
		
		String[] food = {"ラーメン","そば","カレー"};
		Random rFood = new Random();
		int index = rFood.nextInt(food.length);
		return food[index];
	}

}
