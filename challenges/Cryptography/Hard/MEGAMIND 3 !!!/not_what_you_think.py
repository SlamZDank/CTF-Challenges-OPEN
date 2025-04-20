import gmpy2
import random
import os
from Cryptodome.Util.number import bytes_to_long

if os.path.exists("/flag/flag.txt"):
    flag=(open("/flag/flag.txt","r").read()).encode("utf-8")
else:
    flag=(open("flag.txt","r").read()).encode("utf-8")
# Generate a random prime number for use as the encryption key
x = gmpy2.next_prime(gmpy2.mpz(random.getrandbits(1024)))
y = gmpy2.next_prime(x)
z = gmpy2.next_prime(y)

e=0x10001;
n=x*y*z;

# Encrypt the message using the key
c = gmpy2.powmod(bytes_to_long(flag), e, n)


print(open("cifra.py","r").read());

# Print the encrypted message
print("c="+str(c)+"\n");
print("n="+str(n)+"\n");
print("e="+str(e)+"\n");
```