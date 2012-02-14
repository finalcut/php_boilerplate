if test -z "$1"
then
        echo "You did not specify a directory to publish to (within your webroot); usage ./build.sh {directoryName}"
else
	export user=$(whoami)
	git checkout-index -a -f --prefix=/Users/$user/dev/websites/$1/
fi
