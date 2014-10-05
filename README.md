## ![myclapboard-logo](https://raw.githubusercontent.com/myClapboard/myclapboard.api/master/web/logo.png)
> The API of myClapboard developed with Symfony in PHP language.

[![Build Status](https://travis-ci.org/myClapboard/myclapboard.api.svg?branch=master)](https://travis-ci.org/myClapboard/myclapboard.api)
[![Coverage Status](https://img.shields.io/coveralls/myClapboard/myclapboard.api.svg)](https://coveralls.io/r/myClapboard/myclapboard.api) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/myClapboard/myclapboard.api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/myClapboard/myclapboard.api/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/37c28e11-6763-404f-98e9-a4abec3ce058/mini.png)](https://insight.sensiolabs.com/projects/37c28e11-6763-404f-98e9-a4abec3ce058)

Prerequisites
-------------
To start to use this project, you have a **Vagrant** virtual machine in the root directory that provides a completely
functional environment for running *myClapboard API*. This Vagrant that is imported as submodule is maintained by
[benatespina](mailto:benatespina@gmail.com) in this [repository](https://github.com/benatespina/default-vagrant) so, we
are pretty sure that you do not have any problems to use it; however, if you have any kind of question or doubt, do not
hesitate to contact us.

* Install [Vagrant](http://docs.vagrantup.com/v2/installation/index.html) on your system, which in turn requires
[RubyGems](https://rubygems.org/pages/download) and [VirtualBox](https://www.virtualbox.org/wiki/Downloads).

*NOTE: If you are on Windows, I would recommend [RubyInstaller](http://rubyinstaller.org/) for installing Ruby and any
ssh client as [PuTTY](http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html) for log into your Vagrant box.*

* For simplified the usage of this box, you should install
**[vagrant-hostsupdater](https://github.com/cogitatio/vagrant-hostsupdater)** plugin for Vagrant, which adds an entry
to your `/etc/hosts` file on the host system and **[vagrant-vbguest](https://github.com/dotless-de/vagrant-vbguest)**
plugin which automatically installs the host's VirtualBox Guest Additions on the guest system.
```
vagrant plugin install vagrant-hostsupdater
vagrant plugin install vagrant-vbguest
```

Getting started
---------------

The recommended way to clone this project is using the following command because you have to clone the *git submodules*
too:

    git clone --recursive https://github.com/myClapboard/myclapboard.api.git myclapboard.api

Then, into `/vagrant` directory you have to duplicate the Personalization.dist in the same directory but without
extension, modifying the values with your favorite preferences. This is the `Personalization` file that we recommend:

```
$vhost              = "myclapboard.api"
$domain             = "localhost"
$vhostpath          = "/var/www"

$ip                 = "192.168.10.42"
$port               = 8080
$use_nfs            = true
$base_box           = "precise64"

$mysql_rootpassword = "app"
$mysql_user         = "root"
$mysql_password     = "123"
$mysql_database     = "myclapboard"

$is_symfony_env     = true
```

In the next step, you have to build the *Vagrant* machine and then, you have to connect via **ssh** to the VM with the
following commands:

    cd /vagrant
    vagrant up
    vagran ssh

Finally, you have to load all related with the **database** (create database if it is not exist, create schema and load some
fixtures). The recommended way to do all of these steps is executing the following command.

    sh scripts/update_doctrine_dev.sh

And that's all! Now, if you go to the `http://myclapboard.api.localhost/doc` url, you can see all the methods that
are available for now.

Tests
-----

This project is completely tested by **[PHPSpec][1], SpecBDD framework for PHP**.

Because you want to contribute or simply because you want to throw the tests, you have to type the following command
in your terminal.

    phpspec run -fpretty

*Depends the location of the `bin` directory (sometimes in the root dir; sometimes in the `/vendor` dir) the way that
works every time is to use the absolute path of the binary `vendor/phpspec/phpspec/bin/phpspec`*

Contributing
------------

This projects follows PHP coding standards, so pull requests must pass PHP Code Sniffer and PHP Mess Detector
checks. In the root directory of this project you have the **custom rulesets** ([ruleset.xml]() for PHPCS and
[phpmd.xml]() for PHPMD).

There is also a policy for contributing to this project. Pull requests must
be explained step by step to make the review process easy in order to
accept and merge them. New methods or code improvements must come paired with [PHPSpec][1] tests.

If you would like to contribute it is a good point to follow Symfony contribution standards,
so please read the [Contributing Code][2] in the project
documentation. If you are submitting a pull request, please follow the guidelines
in the [Submitting a Patch][3] section and use the [Pull Request Template][4].

[1]: http://www.phpspec.net/
[2]: http://symfony.com/doc/current/contributing/code/index.html
[3]: http://symfony.com/doc/current/contributing/code/patches.html#check-list
[4]: http://symfony.com/doc/current/contributing/code/patches.html#make-a-pull-request

Credits
-------
myClapboard is created by:
>
**@benatespina** - [benatespina@gmail.com](mailto:benatespina@gmail.com)<br/>
**@gorkalaucirica** - [gorka.lauzirika@gmail.com](mailto:gorka.lauzirika@gmail.com)

Licensing Options
-----------------
Released under MIT license. See [LICENSE.md](https://github.com/myClapboard/myclapboard.api/blob/master/LICENSE.md) file for more information.
