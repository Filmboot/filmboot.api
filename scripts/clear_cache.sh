#!/bin/sh

# This file belongs to myClapboard.
# The source code of application includes a LICENSE file
# with all information about license.
#
# @author benatespina <benatespina@gmail.com>
# @author gorkalaucirica <gorka.lauzirika@gmail.com>

echo "Dont use this in production, its dangerous"
php app/console cache:clear -e=dev
sudo chmod -R 777 /dev/shm/symfony/cache
sudo chmod -R 777 /dev/shm/symfony/logs/
