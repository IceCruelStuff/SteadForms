# SteadForms
Plugin for PocketMine-Steadfast2 that allow you create GUI in a few clicks.

![twitter](https://cdn0.iconfinder.com/data/icons/shift-logotypes/32/Twitter-16.png) @LiTEK_

## Features
 - Fast image loading in menu forms.
 - Friendly user API
 - Get text and index for buttons in menu forms.
 - All form tools working
### Code samples

#### ModalForm
```php
$sender->showModal(new ModalForm("A small question", "Our server is cool?", [
    new Button('Yes'),
    new Button('No')
],
	function(Player $player, $response) {
		$player->sendMessage($response ? "Thank you" : "We will try to become better");
	}
));
```
![modal](https://i.imgur.com/eI2xaBL.png)
#### MenuForm
```php
$sender->showModal(new MenuForm(
	"Select server", "Choose server", [new Button("SkyWars #1", new Image("https://gamepedia.cursecdn.com/minecraft_gamepedia/1/19/Melon.png"))],
	function(Player $player, $selected) : void{
		$player->sendMessage("You selected: " . $selected->getText());
		$player->sendMessage("Index of button: " . $selected->getValue());
	}
));
```
![menu](https://i.imgur.com/QewDqkc.png)
#### CustomForm
```php
$sender->showModal(new CustomForm("Enter data", "Content",
	[
		new Dropdown("Select product", ["beer", "cheese", "cola"]),
		new Input("Enter your name", "Bob"),
		new Label("I am label!"), //Note: this return null in response
		new Slider("Select count", 0.0, 100.0, 1.0, 50.0),
		new StepSlider("Select product", ["beer", "cheese", "cola"]),
		new Toggle("Creative", $sender->isCreative())
	],
	function(Player $player, $response) : void{
            $player->sendMessage("Dropdown: " . $response[0]);
            $player->sendMessage("Input: " . $response[1]);
            $player->sendMessage("Label: " . $response[2]); //null
            $player->sendMessage("Slider: " . $response[3]);
            $player->sendMessage("StepSlider: " . $response[4]);
            $player->sendMessage("Toggle: " . $response[5]);
		}
));
```

![custom1](https://i.imgur.com/biAoc91.png)
![custom2](https://i.imgur.com/AFkpS7b.png)
