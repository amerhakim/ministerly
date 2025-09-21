<?php require CONFIG . 'installer_mode_config.php'; ?>
<style type="text/css">
    html, body, body > div:nth-child(2), .wizard-wrapper, .startup-wizard {
        height: 100%;
    }

    .startup-wizard  {
        overflow: auto;
    }
</style>

<div class="wizard-wrapper">
    <div id="spinner" class="spinner-wrapper" style="display: none;">
        <div class="spinner-text">
            <div class="spinner lt-ie9"></div>
            <p><?= __('Loading'); ?> ...</p>
        </div>
    </div>
    <div class="wizard startup-wizard" data-initialize="wizard" id="wizard">

        <div class="steps-container">
            <ul class="steps" style="margin-left: 0">
                <li class="<?=$action == '1' ? 'active' : '' ?>">
                    <div class="step-wrapper">
                        <span><i class="fa fa-lg fa-hand-o-up"></i></span>
                        Step 1: License
                        <span class="chevron"></span>
                    </div>
                </li>
                <li class="<?=$action == '2' ? 'active' : '' ?>">
                    <div class="step-wrapper">
                        <span><i class="fa fa-lg fa-arrows-h"></i></span>
                        Step 2: Setting Up
                        <span class="chevron"></span>
                    </div>
                </li>
                <li class="<?=$action == '3' ? 'active' : '' ?>">
                    <div class="step-wrapper">
                        <span><i class="fa fa-lg fa-map-marker"></i></span>
                        Step 3: Launch Application
                        <span class="chevron"></span>
                    </div>
                </li>
            </ul>
        </div>

        <div class="step-content">
            <?= $this->element('OpenEmis.alert') ?>
            <div class="step-pane sample-pane <?=$action == '1' ? 'active' : '' ?>" data-restrict="1" data-step="1">
                <div class="step-pane-wrapper">
                    <h1>Welcome to <?= APPLICATION_NAME;  ?> </h1>
                    <p style="margin-top: 30px">
                    <?php 
                        if (file_exists(ROOT . DS . 'LICENSE')) {
                            echo file_get_contents(ROOT . DS . 'LICENSE'); 
                        }
                    ?>
                    </p>

                    <p style="margin-top: 30px">
        <strong>Classera License:</strong> Copyright © 2024 Classera. All rights reserved.

        This software and all related materials are the exclusive property of Classera. All intellectual property rights, including copyrights, patents, and trademarks, are owned by Classera and are protected by applicable laws and international treaties.

        This program is licensed, not sold. It is provided under a perpetual license to the authorized licensee, strictly for use in accordance with the terms and conditions set forth in the Classera License Agreement. Any reproduction, redistribution, modification, or use of this software or its components, in whole or in part, is strictly prohibited except as expressly permitted by Classera in writing.

        This program is provided "as is" without warranty of any kind, either express or implied, including but not limited to the implied warranties of merchantability, fitness for a particular purpose, or non-infringement. In no event shall Classera be liable for any damages arising from the use of this software.

        For more information or to obtain a copy of the license agreement, please contact support@classera.com. By using this software, you acknowledge and agree to the terms and conditions of the Classera License Agreement.
                    </p>
                    <div class="form-group">
                        <a href=<?=$this->Url->build(['plugin' => 'Installer', 'controller' => 'Installer', 'action' => 'step2']); ?> type="submit" class="btn btn-default" onClick="(function(){document.querySelector('.spinner-wrapper').style.display='block';})();">Start</a>
                    </div>
                </div>
            </div>
            <?php
                if ($action == '2'):
            ?>


            <div class="step-pane sample-pane <?=$action == '2' ? 'active' : '' ?>" data-restrict="2" data-step="2">
                <div class="step-pane-wrapper">
                    <h1>Setting Environment</h1>
                    <p>All fields are required and case sensitive.</p>

                    <?php
                        echo $this->Form->create($databaseConnection, ['class' => 'form-horizontal']);
                    ?>
                    <!-- Database Connection Information - Auto-configured -->
                    <?php
                        echo $this->Form->input('database_server_host', ['type' => 'hidden', 'value' => 'mysql']);
                        echo $this->Form->input('database_server_port', ['type' => 'hidden', 'value' => '3306']);
                        echo $this->Form->input('database_admin_user', ['type' => 'hidden', 'value' => 'root']);
                        echo $this->Form->input('database_admin_password', ['type' => 'hidden', 'value' => 'classera_root_2024']);
                    ?>
                    <div class="section-header">Administrator Account</div>
                    <div class="clearfix">&nbsp;</div>
                    <?php
                        echo $this->Form->input('account_username', ['class' => 'form-control username', 'value' => 'admin', 'disabled' => true, 'required' => true]);
                        echo $this->Form->input('account_password', ['class' => 'form-control password', 'type' => 'password']);
                        echo $this->Form->input('retype_password', ['class' => 'form-control retype', 'type' => 'password']);
                    ?>
                    <div class="section-header">Country / Area Information</div>
                    <div class="clearfix">&nbsp;</div>
                    <?php
                        echo $this->Form->input('area_code', ['class' => 'form-control area-code', 'type' => 'text', 'maxlength' => '60', 'label' => 'Country Code']);
                        echo $this->Form->input('area_name', ['class' => 'form-control area-name', 'type' => 'text', 'maxlength' => '100', 'label' => 'Country Name']);
                    ?>
                    <div class="clearfix">&nbsp;</div>
                    <div class="">
                        <?= $this->Form->button('Next', ['type' => 'submit', 'class' => 'btn btn-default', 'onclick' => "(function(){
                            if (document.querySelector('.username').value === '' ||
                                document.querySelector('.password').value === '' ||
                                document.querySelector('.retype').value === '' ||
                                document.querySelector('.area-code').value === '' ||
                                document.querySelector('.area-name').value === '') {
                                    document.querySelector('.spinner-wrapper').style.display='none';
                            }
                            else {
                                document.querySelector('.spinner-wrapper').style.display='block';
                            }
                        })();"])?>
                    </div>
                    <?php
                        echo $this->Form->end();
                    ?>
                </div>
            </div>
            <?php
                endif;
                if ($action == '3'):
            ?>
            <div class="step-pane sample-pane <?=$action == '3' ? 'active' : '' ?>" data-restrict="3" data-step="3">
                <div class="step-pane-wrapper">
                    <h1>Installation Completed</h1>
                    <p>You have successfully installed OpenSMIS. Please click Start to launch OpenSMIS.</p>
                    <form class="form-horizontal ng-pristine ng-valid" accept-charset="utf-8" method="post">
                        <div class="form-group">
                            <a href=<?=$this->Url->build(['plugin' => 'User', 'controller' => 'Users', 'action' => 'login']); ?> type="submit" class="btn btn-default" style="text-">Complete</a>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                endif;
            ?>
        </div>

        <div class="actions bottom">
        </div>
    </div>
</div>
