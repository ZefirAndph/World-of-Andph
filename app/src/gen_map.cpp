#include <iostream>
#include <filesystem>
#include "world.hpp"

int error_msg(std::string error) {
    std::cerr << error << std::endl;
    return -1;
}

int main(int argc, char** argv) {
    if(argc < 2)
        return error_msg("undefined world");

    World* w = World::Open(argv[1]);
    if(!w) 
        return error_msg("unable to open world");


        
    delete w;

    return 0;
}
