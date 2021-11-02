<?php
$regions = array(
    'Asia' => DateTimeZone::ASIA,
    'Africa' => DateTimeZone::AFRICA,
    'America' => DateTimeZone::AMERICA,
    'Antarctica' => DateTimeZone::ANTARCTICA,
    'Atlantic' => DateTimeZone::ATLANTIC,
    'Europe' => DateTimeZone::EUROPE,
    'Indian' => DateTimeZone::INDIAN,
    'Pacific' => DateTimeZone::PACIFIC
);

$timezoneArray = array();
foreach ($regions as $timezoneName => $mask)
{
    $zones = DateTimeZone::listIdentifiers($mask);
    foreach($zones as $timezone)
    {
		$time = new DateTime(NULL, new DateTimeZone($timezone));
		$ampm = $time->format('H') > 12 ? ' ('. $time->format('g:i a'). ')' : '';
		$timezoneArray[$timezoneName][$timezone] = substr($timezone, strlen($timezoneName) + 1) . ' - ' . $time->format('H:i') . $ampm;
	}
}
?>