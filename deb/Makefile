.PHONY: all clean 

all:
	composer install
	mkdir -p build/DEBIAN
	mkdir -p build/etc/dialtime/web
	mkdir -p build/usr/bin
	mkdir -p build/usr/share/doc/dialtime-web
	mkdir -p build/usr/share/dialtime/web/app
	mkdir -p build/usr/share/dialtime/web/vendor
	mkdir -p build/usr/share/dialtime/web/web
	mkdir -p build/var/cache/dialtime/web
	mkdir -p build/var/log/dialtime/web
	mkdir -p build/var/lib/dialtime/sessions
	cp config/* build/etc/dialtime/web/
	cp bin/* build/usr/bin/
	cp app/* build/usr/share/dialtime/web/app/
	cp -r vendor/* build/usr/share/dialtime/web/vendor/
	cp -r web build/usr/share/dialtime/web
	cp -t build/DEBIAN deb/postinst deb/preinst deb/conffiles deb/config deb/templates
	sed -e "s/^Installed-size.*/Installed-size: `du -s build/ | grep -o [0-9]*`/" deb/control > build/DEBIAN/control
	cp deb-doc/* build/usr/share/doc/dialtime-web/
	gzip -9 build/usr/share/doc/dialtime-web/changelog
	chmod 0644 build/etc/dialtime/web/* build/usr/share/doc/dialtime-web/* build/DEBIAN/*
	chmod 0755 build/DEBIAN/postinst build/DEBIAN/preinst build/DEBIAN/config build/usr/bin/dialtime-web
	chmod 0755 build/usr/share/dialtime/web/web/app.php build/usr/share/dialtime/web/web/app_dev.php
	find build/usr/share/dialtime/web -type f -exec chmod 644 {} \;
	find build/usr/share/dialtime/web -type d -exec chmod 755 {} \;
	find build/usr/share/dialtime/web/vendor/ -name '.git*' -exec unlink {} \;
	find build/usr/share/dialtime/web/vendor/ -name 'LICENSE*' -exec unlink {} \;
	find build/usr/share/dialtime/web/vendor/ -name '*.sh' -exec chmod 775 {} \;
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
