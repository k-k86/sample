package javasample;

public class JavaKeisanClass {

	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		
		System.out.println(35 - 10);
		System.out.println(35 + 10);
		System.out.println(-10 * 5);
		System.out.println(6 * 6 * 3.14);
		
		int num;
		int num2 = 50;
		num = 10;
		
		System.out.println(num + num2 * 3);
		
		int r = new java.util.Random().nextInt(50);
		
		System.out.println("あなたは多分" + r + "歳ですね？");
		
		
		System.out.println("あなたの名前を入力してください");
		
		String name = new java.util.Scanner(System.in).nextLine();
		
		System.out.println("あなたの年齢を入力してください");
		
		int age = new java.util.Scanner(System.in).nextInt();
		
		System.out.println("ようこそ、" + age + "歳の" + name + "さん。");
		
		
				
		

	}

}
