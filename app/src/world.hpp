#ifndef WORLD_HPP
#define WORLD_HPP

#include <filesystem> 

class World {
    private:

    public:
        static World* Open(const std::filesystem::path& path);
    private:
        bool set_world(const std::filesystem::path& path);
};

#endif