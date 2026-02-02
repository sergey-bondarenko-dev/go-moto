<?php

$args ??= [];

extract($args);

if (empty($price)) {
	return;
}
$discounts = carbon_get_theme_option('rent_discounts');

if (empty($discounts)) {
    $discounts = [
        ['percent' => 5,  'days' => 'на 2 дня'],
        ['percent' => 10, 'days' => 'на 3-6 дней'],
        ['percent' => 15, 'days' => 'на 7-14 дней'],
        ['percent' => 20, 'days' => 'на 15 и более дней'],
    ];
}

?>

<div style="margin-block: 1rem;display:flex;align-items:center;flex-direction:column;">
	<div class="rent-prices">
		<div class="rent-prices__title">Стоимость аренды</div>

		<?php foreach ($discounts as $d): ?>
			<?php $final_price = round($price * (1 - $d['percent'] / 100)); ?>

			<div class="rent-prices__row">
				<div class="rent-prices__left">
					<div class="rent-prices__days"><?= $d['days'] ?></div>
					<div class="rent-prices__badge">-<?= $d['percent'] ?>%</div>
				</div>

				<div class="rent-prices__right">
					<span class="rent-prices__price"><?= number_format($final_price, 0, ',', ' ') ?> BYN</span>
					<span class="rent-prices__per">/ сутки</span>
				</div>
			</div>
		<?php endforeach; ?>

	</div>
	<p style="font-size: 12px;text-align:center;margin-block:1rem 0;">
		Скидки суммируются с картами <a href="/gomoto-club/" target="_blank">GoMoto Club</a>
	</p>
</div>

