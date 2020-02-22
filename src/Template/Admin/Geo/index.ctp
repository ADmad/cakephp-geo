<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\ORM\Entity $entity
 */
?>
<h1>Geo Backend</h1>


<h2>Geocode</h2>
<?= $this->Form->create() ?>
<fieldset>
	<legend><?= __('Geocode {0}', __('Address')) ?></legend>
	<?php
	echo $this->Form->control('address');
	//echo $this->Form->control('allow_cache', ['type' => 'checkbox']);

	?>
</fieldset>
<?= $this->Form->button(__('Geocode')) ?>
<?= $this->Form->end() ?>



<?php if ($entity->geocoded) { ?>
<h2>Result</h2>

	<h3><?php echo h($entity->address); ?></h3>
	<p>Formatted Address: <?php echo h($entity->formatted_address); ?></p>
	<p>Lat/Lng: <?php echo h($entity->lat); ?>/<?php echo h($entity->lng); ?></p>

	<?php
	$yes = null;
	if ($entity->geocoded_address) {
		$yes = 'yes (' . $this->Html->link($entity->geocoded_address->address, ['action' => 'view', $entity->geocoded_address->id]) . ')';
	}
	$no = 'no';
	if ($entity->geocoded_address_created) {
		$no .= ' (created ' . $this->Html->link($entity->geocoded_address_created->address, ['action' => 'view', $entity->geocoded_address_created->id]);
	}
	?>

	<p>Used cache: <?php echo $entity->geocoded_address ? $yes : $no; ?></p>


<?php } ?>