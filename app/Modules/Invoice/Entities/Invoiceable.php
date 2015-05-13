<?php namespace HMIF\Modules\Invoice\Entities;

interface Invoiceable {

    public function invoice();

    public function getItemName();

    public function getItemDescription();

    public function getItemPrice();

}