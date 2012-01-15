#!/bin/bash
source $HOME/src/nightly/test/bin/activate
mkdir -p $HOME/data/nightly/test/output
cd $HOME/data/nightly/test
rm -rf pywikipedia
tar -xzf ../package/pywikipedia/pywikipedia-nightly.tgz
cd pywikipedia
cat > user-config.py << $END
usernames['wikipedia']['en'] = 'pwb-nightly-test-runner'
mylang='en'
family='wikipedia'
$END
date > ../output/test_pywikipedia.txt
nosetests --with-xunit --xunit-file=../output/xunit_pywikipedia.xml tests 2>> ../output/test_pywikipedia.txt
cd ..
rm -rf pywikipedia
