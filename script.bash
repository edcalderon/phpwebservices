#!/bin/bash
helpFunction()
{
   echo ""
   echo "Usage: $0 -a parameterA -b parameterB "
   echo -e "\t-a ingrese una extencion "
   echo -e "\t-b ingrese un mensaje "
   exit 1 # Exit script after printing help
}

while getopts "a:b:" opt
do
   case "$opt" in
      a ) parameterA="$OPTARG" ;;
      b ) parameterB="$OPTARG" ;;
      ? ) helpFunction ;; # Print helpFunction in case parameter is non-existent
   esac
done

# Print helpFunction in case parameters are empty
if [ -z "$parameterA" ] || [ -z "$parameterB" ]
then
   echo "Some or all of the parameters are empty";
   helpFunction
fi

# Begin script in case all parameters are correct

# set the message to the ext 644 in extensions_custom.conf

cd /etc/asterisk

sed -i "11iexten => 644,1,Answer()" extensions_custom.conf
sed -i "12iexten => 644,n,Festival($parameterB)" extensions_custom.conf
sed -i "13iexten => 644,n,Hangup" extensions_custom.conf

# set the extension to the .call

cd /var/spool/asterisk

sed -i "1iChannel:SIP/$parameterA" prueba.call

# reload asterisk

asterisk -rx reload

# make the call and wait

cp prueba.call outgoing/
sleep 18

# Finally delete all the changes and reload again

cd /etc/asterisk

sed -i '11d' extensions_custom.conf
sed -i '11d' extensions_custom.conf
sed -i '11d' extensions_custom.conf

cd /var/spool/asterisk

sed -i '1d' prueba.call
 
asterisk -rx reload
