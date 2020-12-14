<?php

class Order
{
	public const EVENT_ON_ORDER_SAVE = 'onOrderSave';

	protected $number;
	private $orderBus;

	public function __construct(OrderBus $orderBus)
	{
		$this->number = rand(10000, 20000);
		$this->orderBus = $orderBus;

	}

	public function save(): void
	{
		echo "Order number {$this->number} was saved\n";
		$this->orderBus->publish(self::EVENT_ON_ORDER_SAVE, $this);
	}

	public function getNumber(): string
	{
		return $this->number;
	}
}

class TelegramSender
{
	public function send($message): void
	{
		echo "Message was sent via telegram: {$message}\n";
	}
}

class EmailSender
{
	public function send($message): void
	{
		echo "Message was sent via e-mail: {$message}\n";
	}
}

class OrderBus
{
	protected $subscribers;

	public function subscribe(string $eventType, callable $eventHandler): void
	{
		if (!isset($this->subscribers[$eventType]))
		{
			$this->subscribers[$eventType] = [];
		}
		$this->subscribers[$eventType][] = $eventHandler;
	}

	public function publish(string $eventType, $data): void
	{
		if (is_array($this->subscribers[$eventType]))
		{
			foreach ($this->subscribers[$eventType] as $eventHandler)
			{
				$eventHandler($data);
			}
		}
	}
}


$telegramSender = new TelegramSender();
$emailSender = new EmailSender();
$orderBus = new OrderBus();

$orderBus->subscribe(Order::EVENT_ON_ORDER_SAVE,
	function(Order $order) use ($telegramSender)
	{
		$telegramSender->send("{$order->getNumber()} was saved");
	});
$orderBus->subscribe(Order::EVENT_ON_ORDER_SAVE,
	function(Order $order) use ($emailSender)
	{
		$emailSender->send("{$order->getNumber()} was saved");
	});


$order = new Order($orderBus);
$order->save();
echo PHP_EOL;

$order = new Order($orderBus);
$order->save();


/*
 * Необходимо воспользоваться шаблоном проектирования "Издатель подписчик"
 * Чтобы при каждом сохранении заказа
 * $order->save();
 * сообщения об этом отправлялись через
 * TelegramSender и EmailSender
 */