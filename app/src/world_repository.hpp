#ifndef WORLD_REPOSITORY_HPP
#define WORLD_REPOSITORY_HPP

#include <filesystem>
#include "shared_defines.hpp"

class WorldRepository {
    private:
        std::filesystem::path mRootPath;
    public:
        WorldRepository(const std::filesystem::path& path);
        static WorldRepository* Initialize(const std::filesystem::path& path);
        int Count(const std::string& id_path);
        std::vector<sDocument> LoadNode(const std::string& id_path);
        sDocument LoadFile(const std::string& id_path);
    private:
        std::filesystem::path create_path_from_id(const std::string& id_path);
        std::string create_id_from_path(const std::filesystem::path& path);
};

#endif
