#!/bin/bash
#
# Script to create nightly versions for pywikipediabot
# See README for more information
#
# (C) Merlijn 'valhallasw' van Deen, licensed under the MIT license.

SVN_DIR=$HOME/data/nightly/svn
PACKAGE_DIR=$HOME/data/nightly/package
LOG_DIR=$HOME/data/nightly/log

cd $SVN_DIR
mkdir -p $PACKAGE_DIR
mkdir -p $LOG_DIR

date > $PACKAGE_DIR/packages

# for each directory
find . -maxdepth 1 -name '[!.]*' -type d | sed -e 's/\.\///' | sort | while read i
do
  cd $i
  mkdir -p $PACKAGE_DIR/$i
  mkdir -p $LOG_DIR/$i

  echo $i >> $PACKAGE_DIR/packages

  # create version information file
  echo nightly:$i > version
  head -n 11 .svn/entries | tail -n 2 >> version
  
  # update the SVN checkout
  svn up --ignore-externals > $LOG_DIR/$i/svn.log
  svn log --limit 1 | grep -v -e '-\{72\}' > $LOG_DIR/$i/latest.log

  # create packages
  cd ..
  rm $PACKAGE_DIR/$i/$i-nightly.*
  CMD=( "zip -r $PACKAGE_DIR/$i/$i-nightly.zip $i/"
        "tar -cvjf $PACKAGE_DIR/$i/$i-nightly.tar.bz2 --exclude=.svn* $i"
	"tar -cvzf $PACKAGE_DIR/$i/$i-nightly.tgz --exclude=.svn* $i"
        "7z a -xr!.svn $PACKAGE_DIR/$i/$i-nightly.7z $i"
      )
  LOG=( "zip.log" "tar.bz2.log" "tgz.log" "7z.log" )

  for ((n=0; n<${#CMD[@]};n++)); do
    C="${CMD[$n]}"
    L="$LOG_DIR/$i/${LOG[$n]}"
    date > $L
    echo `pwd`$ $C >> $L
    $C >> $L
  done
  chmod +r $PACKAGE_DIR/$i/$i-nightly.*

  # copy README files
  touch $i/README
  cp $i/README $PACKAGE_DIR/$i
done
