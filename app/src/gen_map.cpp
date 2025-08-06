#include <iostream>

#include "world_service.hpp"

int error_msg(std::string error) {
    std::cerr << error << std::endl;
    return -1;
}

int main(int argc, char** argv) {
    if(argc < 2)
        return error_msg("undefined world");

    WorldService* pWorld = new WorldService(argv[1]);
    
    for(auto& item: pWorld->GetAllMaps())
        std::cout << item.Id << std::endl;

    delete pWorld;

    return 0;
}
