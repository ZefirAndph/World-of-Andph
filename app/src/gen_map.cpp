#include <iostream>
#include <filesystem>
#include "gen_map.hpp"

int Error(const char* error_msg) {
    std::cerr << "Error: " << error_msg << std::endl;
    return 1;
}

int main(int argc, char** argv) {
    if(argc < 2)
        return Error("Too few arguments");

    return 0;
}

GenMap::GenMap(int argc, char** argv) {

}