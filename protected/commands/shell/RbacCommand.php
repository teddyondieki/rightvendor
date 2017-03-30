<?php

class RbacCommand extends CConsoleCommand {

    private $_authManager;

    public function getHelp() {
        return <<<EOD
USAGE
rbac
DESCRIPTION
This command generates an initial RBAC authorization hierarchy.
EOD;
    }

    /**
     * Execute the action.
     * @param array command line parameters specific for this command
     */
    public function run($args) {
//ensure that an authManager is defined as this is mandatory for creating an auth heirarchy
        if (($this->_authManager = Yii::app()->authManager) === null) {
            echo "Error: an authorization manager, named 'authManager'
must be configured to use this command.\n";
            echo "If you already added 'authManager' component in
application configuration,\n";
            echo "please quit and re-enter the yiic shell.\n";
            return;
        }
//provide the oportunity for the use to abort the request
        echo "This command will create two roles: Vendor, and Admin and the following premissions:\n";
        echo "create, read, update and delete user\n";
        echo "create, read, update and delete project\n";
        echo "create, read, update and delete issue\n";
        echo "Would you like to continue? [Yes|No] ";
//check the input from the user and continue if they indicated yes to the above question
        if (!strncasecmp(trim(fgets(STDIN)), 'y', 1)) {
//first we need to remove all operations, roles, child relationship and assignments
            $this->_authManager->clearAll();

            $this->_authManager->createOperation("profileManagement", "manage their profile");
            $this->_authManager->createOperation("projectManagement", "manage their projects");

            $this->_authManager->createOperation("siteManagement", "manage the whole site");

//create the vendor role and add the appropriate permissions as children to this role
            $role = $this->_authManager->createRole("vendor");
            $role->addChild("profileManagement");
            $role->addChild("projectManagement");


//create the admin role, and add the appropriate permissions, as well cook role itself, as children
            $role = $this->_authManager->createRole("admin");
            $role->addChild("vendor");
            $role->addChild("siteManagement");

//provide a message indicating success
            echo "Authorization hierarchy successfully generated.";
        }
    }

}
