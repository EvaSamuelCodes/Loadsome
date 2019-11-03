<?php

// Resoning behind creating a core class
// 1. It's light, makes it so that I don't have to declare and redeclare dependencies.
// 2. It's in the middle, so if there's a piece of functionality that needs to go everywhere... 
//    this is an easy way to go about doing it.

class Core{
    use Helpers;
    use Routing;
    use Views;
}