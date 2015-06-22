<?php

$metadata->isEmbeddedDocument = true;

$metadata->mapField(array(
    'fieldName' => 'amount',
    'type' => 'int',
    'nullable' => true
));

$metadata->mapField(array(
    'fieldName' => 'currency',
    'type' => 'currency',
    'nullable' => true
));
