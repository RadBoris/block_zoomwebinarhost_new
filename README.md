Moodle Block Zoom Helper
=====================

* Go to Site Administration > Plugins > Blocks > Manage blocks
and you should find that this newblock has been added to the list of
installed modules.

* For testing, use bitnami images for MariaDB and Moodle -- use `docker pull bitnami/moodle` to get the images.

* Get the docker-compose.yml file `curl -sSL https://raw.githubusercontent.com/bitnami/bitnami-docker-moodle/master/docker-compose.yml > docker-compose.yml`

* Data will persist by default but changes need to be made to the docker-compose.yml file so that all dependencies are loaded --vim, git, node and npm. If the containers are stopped and then restarted using the default, these dependencies will have to to be reinstalled.

* Run `grunt --force` to override the strict default rules for theme files 

