#ifndef SHARED_DEFINES_HPP
#define SHARED_DEFINES_HPP

#include <string>
//#include <vector>
//#include <unordered_map>

struct IntVector2d {
    int X;
    int Y;
};

struct FloatVector2d {
    float X;
    float Y;
};

struct sMap {
    std::string Id;
    std::string Name;
};

struct sDocument {
    std::string Id;
    std::string Content;

    sMap AsMap();
};

#endif