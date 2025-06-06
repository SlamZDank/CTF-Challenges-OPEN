import base64
from binascii import hexlify
import os
import struct
from flag import a b p

def xorstrings(a, b):
    result = b''
    for i in range(len(a)):
        result += struct.pack("B", (ord(a[i]) ^ ord(b[i])))
    return result

def main():
   

    aCipher = xorstrings(a, p)
    bCipher = xorstrings(b, p)

    print("Encoded A: " + aCipher.hex())
    print("Encoded B:" + bCipher.hex())
    
    print("")
    
    aHex = xorstrings(aCipher.decode('ascii'), p)
    bHex = xorstrings(bCipher.decode('ascii'), p)

    print("Original A: " + aHex.hex())
    print("Original B: " + bHex.hex())
    
    print("")
    
    print("A XOR A: " + xorstrings(aCipher.decode('ascii'), a).hex())
    print("B XOR B: " + xorstrings(bCipher.decode('ascii'), b).hex())

main()