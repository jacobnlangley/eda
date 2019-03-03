<?php

class CFMViewSubmissions_cfm {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  private $model;

  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct($model) {
    $this->model = $model;
  }

  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function display($form_id) {
    ?>
    <div class="fm-user-manual">
      <span style="color: #FF0000;"><?php echo __("This feature is disabled for the non-commercial version.","contact_form_maker"); ?></span>
    </div>
     <div style="clear:both;">
      <img style="max-width: 100%;" src="<?php echo WD_CFM_URL . '/images/screenshots/sub.png'; ?>" />
    </div>
    <?php
  }
}

?>
