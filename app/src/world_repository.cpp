#include "world_repository.hpp"
#include "shared_defines.hpp"
#include <filesystem>
//#include <iostream>

WorldRepository::WorldRepository(const std::filesystem::path& path)
: mRootPath(path) {
    
}

WorldRepository* WorldRepository::Initialize(const std::filesystem::path& path) {
    if(!std::filesystem::exists(path))
        return nullptr;

    return new WorldRepository(path);
}

int WorldRepository::Count(const std::string& id_path) {
    std::filesystem::path directory = create_path_from_id(id_path);

    if (!std::filesystem::exists(directory) || !std::filesystem::is_directory(directory))
        return -1;

    int count = 0;

    for (const auto& entry : std::filesystem::directory_iterator(directory))
        if (entry.is_regular_file() && entry.path().extension() == ".md")
            ++count;

    return count;
}

std::filesystem::path WorldRepository::create_path_from_id(std::string id_path) {
    return mRootPath / id_path;
}

std::vector<sDocument> WorldRepository::LoadNode(const std::string& node_path) {
    std::vector<sDocument> docs;
    return docs;
}

sDocument WorldRepository::LoadFile(const std::string& id_path) {
    return sDocument();
}

