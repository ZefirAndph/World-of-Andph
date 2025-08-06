#include "world_service.hpp"
#include "world_repository.hpp"
#include <iostream>
WorldService::WorldService(WorldRepository* repo) : pRepo(repo) {

}

WorldService::WorldService(const std::filesystem::path& path){
    pRepo = WorldRepository::Initialize(path);
}

std::vector<sMap> WorldService::GetAllMaps() {
    std::vector<sMap> retv;
    int maps_count = pRepo->Count("map");
    std::cout << "Maps count: " <<maps_count << std::endl;
    if(maps_count == cMaps.size()) {

        retv.reserve(cMaps.size());
        
        for(auto& item: cMaps)
            retv.push_back(item.second);

        return retv;
    }

    for(auto& item: pRepo->LoadNode("map")){
        retv.push_back(item.AsMap());
        cMaps[item.Id] = item.AsMap();
    }
    return retv;
}