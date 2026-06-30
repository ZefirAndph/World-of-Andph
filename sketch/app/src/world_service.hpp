#ifndef WORLD_SERVICE_HPP
#define WORLD_SERVICE_HPP

#include <unordered_map>

#include "shared_defines.hpp"
#include "world_repository.hpp"

class WorldService {
    private:
        WorldRepository* pRepo = nullptr;
        std::unordered_map<std::string, sMap> cMaps;
    public:
        WorldService(WorldRepository* repo);
        WorldService(const std::filesystem::path& path);
        //static WorldService* Initialize(const std::filesystem::path& path);
    public:
        std::vector<sMap> GetAllMaps();
};

#endif
