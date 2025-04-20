from Crypto.Util.number import bytes_to_long, getPrime
from secret import flag

flag = bytes_to_long(flag)
p = getPrime(2048)
q = getPrime(2048)
c = pow(flag, p, q)  # i believe this is the fancy rsa encryption?
n= p*q
print(f'{n=}')
print(f'{c=}')

