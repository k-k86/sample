package javasample;

public class SwitchClass {

	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		
		System.out.print("［メニュー]1:検索 2:登録 3:削除 4:変更>");
		int selected = new java.util.Random().nextInt(6) +1;
		System.out.println(selected);
		
		switch(selected) {
			case 1 -> {
				System.out.print("検索します");
			}
			
			case 2 -> {
				System.out.print("登録します");
			}
			
			case 3 -> {
				System.out.print("削除します");
			}
			case 4 -> {
				System.out.print("変更します");
				
			}
		}

	}

}
