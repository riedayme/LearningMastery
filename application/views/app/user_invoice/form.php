<!-- Modal -->
<form id="form-invoice" data-action="<?php echo base_url('app/user_invoice/process') ?>" method="POST">
    <div class="c-modal c-modal--huge modal fade" id="modal" tabindex="-1">
        <div class="c-modal__dialog modal-dialog" role="document">
            <div class="c-modal__content">
                <div class="c-modal__header">
                    <h3 class="c-modal__title">
                        Detail Invoice
                    </h3>
                    <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </span>
                </div>
                <div class="c-modal__body row">

                    <div class="col-12 col-xl-6">
                        <table class="c-table" style="display: table">
                            <tbody class="c-table__head">
                                <tr class="c-table__row">
                                    <td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        Order ID
                                    </td>
                                    <td id="inv-id" class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        ...
                                    </td>
                                </tr>                        
                                <tr class="c-table__row">
                                    <td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        User
                                    </td>
                                    <td id="inv-username" class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        ...
                                    </td>
                                </tr>
                                <tr class="c-table__row">
                                    <td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        Buy
                                    </td>
                                    <td id="inv-product" class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        ...
                                    </td>
                                </tr>
                                <tr class="c-table__row">
                                    <td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        Payment
                                    </td>
                                    <td id="inv-payment" class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        ...
                                    </td>
                                </tr>
                                <tr class="c-table__row">
                                    <td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        Amount
                                    </td>
                                    <td id="inv-amount" class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        ...
                                    </td>
                                </tr>
                                <tr class="c-table__row u-bg-success">
                                    <td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        Sender
                                    </td>
                                    <td id="inv-sender" class="u-border-right u-pv-xsmall u-ph-small u-text-left">
                                        ...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12 col-xl-6">

                        <table class="c-table">
                            <tbody class="c-table__head">
                                <tr class="c-table__row">
                                    <td class="u-border-right u-pv-xsmall u-ph-small u-text-center">
                                        Proof
                                    </td>
                                </tr>
                                <tr class="c-table__row">
                                    <td class="u-border-right u-pv-xsmall u-ph-small u-text-left" colspan="2">
                                        <a id='inv-proof-data-link' target="_blank" data-href="<?php echo base_url('storage/assets/user/img/proof-default.jpg') ?>">
                                            <img id='inv-proof-data-file' width="100%" data-src="<?php echo base_url('storage/assets/user/img/proof-default.jpg') ?>" alt="proof"/>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="c-modal__footer">
                    <input type="hidden" name="id">
                    <button data-title="are you sure ?" data-text="approve this invoice" title="Active User Multiple" class="c-btn c-btn--info c-btn--custom invoice-button" name="action" type="button" value="approve">
                        <i class="fa fa-check"></i>
                    </button>
                    <button data-title="are you sure ?" data-text="disapproved this invoice" title="Active User Multiple" class="c-btn c-btn--danger c-btn--custom invoice-button" name="action" type="button" value="disapproved">
                        <i class="fa fa-ban"></i>
                    </button>
                </div>

            </div><!-- // .c-modal__content -->

        </div><!-- // .c-modal__dialog -->
    </div><!-- // .c-modal -->
</form>