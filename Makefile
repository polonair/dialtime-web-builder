.PHONY: all clean 

all:
	cd deb/; $(MAKE) all
	cd zip/; $(MAKE) all
	mkdir -p ./out
	cp deb/out/* ./out/
	cp zip/out/* ./out/

clean:
	cd deb/; $(MAKE) clean
	cd zip/; $(MAKE) clean	
	rm -rf out
