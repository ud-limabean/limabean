#!/bin/bash
#
# Update Fusion Table with limabean project data and record in change table
#
# Ben Mearns

# Global Declarations
declare -rx DATESTRING=$(date +%m%d%y)
declare -rx DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
declare -rx DATAFILE=$DIR/data/$DATESTRING.csv
declare -rx CHANGETABLE_ID=1HAvac1Iy4LsNqBkezgVJX04hwcKvWh4sGpNo7u8
declare -rx DATATABLE_ID=1poH7Gdu_7R3NiCA_EonEMwyf90KY_zrujddYCX4
declare -rx DATAIDCOLUMN=div_measurement_id

# Need to be in ftapi to run Fusion Table executables
cd $DIR/ftapi/

# Sanity Checks
function checkChanges(){ ./ftsql.sh "SELECT * from $CHANGETABLE_ID where change = $DATESTRING" ; }

function checkDuplicates(){ newIds= ; while IFS=',' read f1 f2 f3 f4 f5 f6 f7 f8 f9 f10 ; do if [ -z "$newIds" ] ; then newIds="'$f1'" ; else newIds="$newIds,'$f1'" ; fi done < $DATAFILE ;  ./ftsql.sh "SELECT COUNT($DATAIDCOLUMN) from $DATATABLE_ID where $DATAIDCOLUMN in ($newIds)" ; }

if test ! -e "$DATAFILE" ; then
      printf "Today's data file $DATAFILE does not exist. \n"
      exit
fi

if [ "$(checkChanges)" != "change" ] ; then
      printf "Changes for today ($DATESTRING) have already been commited. \n";
      exit
fi

if [ "$(checkDuplicates)" != "COUNT(div_measurement_id)" ] ; then
      printf "Duplicates have been detected between $DATAFILE and the fusion table. \n";
      exit
fi

# Update Fusion Table with limabean project data and record in change table
cat $DATAFILE | ./ftupload.sh $DATATABLE_ID
./ftsql.sh "INSERT INTO $CHANGETABLE_ID (change) VALUES ('$DATESTRING')"
echo "Updates sent to Fusion Tables successfully"

# Cleanup
exit 0  # all is well
