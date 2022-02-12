<!-- Modal -->
<div class="c-modal c-modal--small modal fade" id="app-about" tabindex="-1" role="dialog" aria-labelledby="app-about">
    <div class="c-modal__dialog modal-dialog" role="document">
        <div class="modal-content">
            <header class="c-modal__header">
                <h1 class="c-modal__title">
                    About Application
                </h1>
                <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </span>
            </header>
            <div class="c-modal__body u-p-zero">

                <div class="c-table-responsive">

                    <table class="c-table c-table--highlight" style="display: table;">
                        <tbody>
                            <tr class="c-table__row">
                            <td class="c-table__cell u-text-bold u-width-25">Name
                                </td>
                                <td class="c-table__cell">
                                    <?php echo APP_NAME ?>                                
                                </td>
                            </tr>
                            <tr class="c-table__row">
                                <td class="c-table__cell u-text-bold">Version
                                </td>
                                <td class="c-table__cell">
                                    <?php echo APP_VERSION ?>                                     
                                </td>
                            </tr>
                            <tr class="c-table__row">
                                <td class="c-table__cell u-text-bold">Creator
                                </td>
                                <td class="c-table__cell">
                                    <?php echo APP_CREATOR ?>                                                  
                                </td>
                            </tr>
                            <tr class="c-table__row">
                                <td class="c-table__cell u-text-bold">Social Media / Website
                                </td>
                                <td class="c-table__cell">
                                    <a target="_blank" href="<?php echo APP_CREATOR_URL ?>">
                                        <i class="fa fa-instagram fa-2x"></i>
                                    </a>
                                    <a target="_blank" href="<?php echo APP_CREATOR_WEBSITE ?>">
                                        <i class="fa fa-globe fa-2x"></i>
                                    </a>
                                </td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>

            </div>            
        </div>
    </div>
</div>