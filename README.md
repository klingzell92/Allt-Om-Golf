[![Build Status](https://travis-ci.org/klingzell92/Allt-Om-Golf.svg?branch=master)](https://travis-ci.org/klingzell92/Allt-Om-Golf)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/klingzell92/Comment/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/klingzell92/Comment/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/klingzell92/Comment/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/klingzell92/Comment/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/klingzell92/Comment/badges/build.png?b=master)](https://scrutinizer-ci.com/g/klingzell92/Comment/build-status/master)


Allt Om Golf
==================================
Installera hemsida
--------------

För att installera hemsidan behöver du bara köra en git pull
--------------------------

composer require phkl16/comment

Router files
--------------

```shell
rsync -av vendor/phkl16/comment/config/route2/comment.php config/route2
rsync -av vendor/phkl16/comment/config/route2/userController.php config/route2
```

You need to include the router file in your router configuration config/route.php. There is a sample you can use in vendor/phkl16/comment/config/route2.php.

View files
------------------
```shell
rsync -av vendor/phkl16/comment/view/* view/
```

```
 .  
..:  Copyright (c) 2017 Philip Klingzell (philip.klingzell@gmail.com)
```
