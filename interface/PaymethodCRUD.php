<?php
include_once '../../model/Paymethod.php';

interface PaymethodCRUD{
    public function selectAll(Paymethod $paymethod);
    public function selectPaymethod(Paymethod $paymethod);
    public function insertPaymethod(Paymethod $paymethod);
    public function updatePaymethod(Paymethod $paymethod);
    public function deletePaymethod(Paymethod $paymethod);

    public function selectLastPaymethod(Paymethod $paymethod);
}

?>