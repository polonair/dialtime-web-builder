.PHONY: all clean 

VERSION=$(shell php getversion)

all:
	composer install
	mkdir -p build
	mkdir -p out
	cp -rt build app bin var vendor web composer.json composer.lock
	cd build; zip -r ../out/dialtime-web_$(VERSION).zip ./*

clean:
	rm -rf vendor out build
	find ./ -name '*~' -exec unlink {} \;
