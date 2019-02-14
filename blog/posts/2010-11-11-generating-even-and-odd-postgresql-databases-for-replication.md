---
title: "Generating Even and Odd PostgreSQL Databases for Replication"
tags: 
    - bucardo
    - database
    - Linux
    - PHP
    - postgre
    - postgresql
    - programming
    - replication
    - rubyrep
    - sql
    - ubuntu
category: "PHP"
---
I was recently faced with a problem of replicating two PostgreSQL databases with
bucardo. The replication was to be in a master-master fashion so that the
databases could be updated on both ends. Although this task can easily be
handled by bucardo it requires that the two different systems generate
completely different sets of primary keys. According to the Bucardo website
(http://bucardo.org/wiki/Bucardo/Sequences) there are three ways of achieving
this difference. <!--more-->
Their approaches were:
> If you are using a swap sync,  the best practice is to *not* replicate sequences, but to make sure 
that they are different on both sides, such that an insert on database A  will
never conflict with an insert on database B. There are three  general ways to do
this:
1. Use interleaving sequences. On database A, define the sequence  as START
WITH 1 INCREMENT BY 2. On database B, define the sequence as  START WITH 2
INCREMENT BY 2. Thus, the two sequences will never have the  same value.
2. Use different ranges. For example, database A would use a  sequence of
START WITH 1, while database B uses START WITH 100000000.  This is not
foolproof, as A can eventually catch up with B, although you  can define A as
MAXVALUE 99999999.
3. Use a common sequence. This relies on one or both of the databases using a
function that makes a call to an external sequence

After reading this I decided to go by the first approach so I wrote a script to
alter the sequences.

````
<?php
// Add the sequences you dont want affected here. The schema doesn't
// really matter.
$exclude = array(
    'client_code_seq',
    'jv_number_seq',
    'pv_number_seq',
);

for ($i = 1; $i &lt; $argc; $i++)
{
    if(substr($argv[$i], 0, 2) == "--")
    {
        $parameter = substr($argv[$i], 2, strlen($argv[$i]) - 2);
        $i++;
        $$parameter = $argv[$i];
    }
    else
    {
        $tables[] = $argv[$i];
    }
}

$conn = pg_connect("host=$host port=5432 dbname=$db user=$user
password=$password");

pg_query($conn,"BEGIN");
$sequences_result = pg_query($conn, "SELECT * FROM
information_schema.sequences");
$sequences = array();
while($sequence = pg_fetch_assoc($sequences_result))
{
    if(array_search($sequence['sequence_name'], $exclude) !== false)
    {
        echo "Skipping " . $sequence['sequence_schema'] . '.' .$sequence['sequence_name'] . "\n";
        continue;
    }
    $sequence = $sequence['sequence_schema'] . '.' . $sequence['sequence_name'];
    $value = pg_query($conn, "SELECT last_value from $sequence");
    $value = pg_fetch_assoc($value);

    pg_query($conn, "ALTER SEQUENCE $sequence INCREMENT BY 2");

    if($value["last_value"] % 2 == 0 && $mode == 'odd')
    {
        pg_query($conn, "ALTER SEQUENCE $sequence RESTART WITH " .($value['last_value'] + 1));
    }
    elseif(($value["last_value"] % 2 == 1 || $value["last_value"] == 1) && $mode == 'even')
    {
        pg_query($conn, "ALTER SEQUENCE $sequence RESTART WITH " . ($value['last_value'] + 1));
    }
}
pg_query($conn,"COMMIT");
````

This script takes five required parameters. The parameters are not validated so
if it is wrongly specified the consequences are unknown. **PLEASE BE CAREFUL!**
The parameters are:

1. The hostname
2. The username
3. The password
4. The database name
5. The mode of the change (even or odd)

An example usage could be

    php update_sequences.php --host db1.accra.srv --user postgres --password somepass --db appcore --mode even

Hope that helps. Happy Programming!

