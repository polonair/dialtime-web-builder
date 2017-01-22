.PHONY: all clean 

all:
	composer install
	mkdir -p build/DEBIAN
	mkdir -p build/etc/dialtime/api
	mkdir -p build/usr/bin
	mkdir -p build/usr/share/doc/dialtime-api
	mkdir -p build/usr/share/dialtime/api/app
	mkdir -p build/usr/share/dialtime/api/vendor
	mkdir -p build/usr/share/dialtime/api/web
	mkdir -p build/var/cache/dialtime/api
	mkdir -p build/var/log/dialtime/api
	mkdir -p build/var/lib/dialtime/sessions
	cp config/* build/etc/dialtime/api/
	cp bin/* build/usr/bin/
	cp app/* build/usr/share/dialtime/api/app/
	cp -r vendor/* build/usr/share/dialtime/api/vendor/
	cp -r web build/usr/share/dialtime/api
	cp -t build/DEBIAN deb/postinst deb/preinst deb/conffiles deb/config deb/templates
	sed -e "s/^Installed-size.*/Installed-size: `du -s build/ | grep -o [0-9]*`/" deb/control > build/DEBIAN/control
	cp deb-doc/* build/usr/share/doc/dialtime-api/
	gzip -9 build/usr/share/doc/dialtime-api/changelog
	chmod 0644 build/etc/dialtime/api/* build/usr/share/doc/dialtime-api/* build/DEBIAN/*
	chmod 0755 build/DEBIAN/postinst build/DEBIAN/preinst build/DEBIAN/config build/usr/bin/dialtime-api
	chmod 0755 build/usr/share/dialtime/api/web/app.php build/usr/share/dialtime/api/web/app_dev.php
	find build/usr/share/dialtime/api -type f -exec chmod 644 {} \;
	find build/usr/share/dialtime/api -type d -exec chmod 755 {} \;
	find build/usr/share/dialtime/api/vendor/ -name '.git*' -exec unlink {} \;
	find build/usr/share/dialtime/api/vendor/ -name 'LICENSE*' -exec unlink {} \;
	find build/usr/share/dialtime/api/vendor/ -name '*.sh' -exec chmod 775 {} \;
	cd build; find usr/ -type f -exec md5deep -rl {} \; >> DEBIAN/md5sums
	cd build; find etc/ -type f -exec md5deep -rl {} \; >> DEBIAN/md5sums
	chmod 0644 build/DEBIAN/md5sums
	mkdir ./out
	fakeroot dpkg-deb --build build ./out

clean:
	rm -rf build vendor out
	rm -rf composer.lock
	rm -rf *.deb
	find ./ -name '*~' -exec unlink {} \;
