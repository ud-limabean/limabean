commands
========

The following commands are used to create supporting files for the limabean project

use GUI to load in csv from elsewhere into sqllite db, limabean.sqlite... this must be automated via bash script/cron

SELECT AddGeometryColumn('locality', 'geometry',
  4326, 'POINT', 'XY', 2);
  
UPDATE locality SET geometry=MakePoint(longitude, latitude, 4326)

C:\Users\mearns\Documents\GitHub\limabean\backend>ogr2ogr -f "GeoJSON" -overwrite -sql "SELECT * FROM locality" ..\limabean.js limabean.sqlite

add 'var locality = ' to the front of the .js output in the last command

used default data in tilemill gui and exported as .mbtiles

created an arbitrary basemap
C:\Users\mearns\Google Drive>gdal2tiles C:\Users\mearns\Dropbox\work\projects\limabean\limabean.mbtiles